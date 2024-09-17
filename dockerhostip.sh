#!/bin/sh
export DOCKERHOSTIP=$(route -n | awk '/UG[ \t]/{print $2}')
export CONTAINERIP=$(hostname -I | awk '{print $1}')
echo "Docker Host IP: $DOCKERHOSTIP"
exec "$@"
