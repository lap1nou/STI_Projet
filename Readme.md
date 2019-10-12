# STI - Readme Projet 01

Author: Victor Truan, Jérôme Bagnoud

## Step 1 - Rights on files
```
Verify that 'other' user have 'rw-' permission to all files in 'site' directory.
Type 'sudo chmod -R o+rw site/' for example.

You should also had the right to pull docker image and start docker container.
```

## Step 2 - Starting project
```
Type 'sudo ./start.sh' to launch the starting script.
```

## Step 3 - Browsing project
```
Go to  URL: http://${DOCKER_IP}/

To find the docker IP you can execute this command: 

sudo docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' sti_project
```

## Step 4 - Accounts
```
Two accounts are accesible:

Account 1:
Username: admin
Password: 1234
Role: 1(Administrator)

Account 2:
Username: user
Password: 1234
Role: 0(Collaborator)
```

## Step 5 - Stopping
```
Type 'sudo ./stop.sh' if you want to close the docker.
```