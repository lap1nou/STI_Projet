#!/bin/bash
docker run --name sti_project --ip 172.17.0.2 -i -t -p "80:80" -p "3306:3306" -v ${PWD}/home:/app -v ${PWD}/mysql:/var/lib/mysql sti_image
docker cp /home/lapinou/HEIG/BA5/STI/Projet/apache2.conf sti_project:/etc/apache2/
