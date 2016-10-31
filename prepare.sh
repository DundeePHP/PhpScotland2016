#!/bin/bash

LIST=`ls`

for i in $LIST; do
	echo "Looking in $i"
	if [ -d $i ]; then
		if [ -e $i/src/composer.json ]; then
			pushd $i/src > /dev/null
			composer update
			popd > /dev/null
		fi
	fi
done




