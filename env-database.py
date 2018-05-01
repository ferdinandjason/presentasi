from getpass import getpass

DB_DATABASE = input('DB_DATABASE : ')
DB_USERNAME = input('DB_USERNAME : ')
DB_PASSWORD = getpass('DB_PASSWORD : ')

with open('.env','r+') as f:
	s = f.read()
	s = s.replace('DB_DATABASE=homestead','DB_DATABASE='+DB_DATABASE)
	s = s.replace('DB_USERNAME=homestead','DB_USERNAME='+DB_USERNAME)
	s = s.replace('DB_PASSWORD=secret','DB_PASSWORD='+DB_PASSWORD)
	f.write(s)

print('Config .env success')
