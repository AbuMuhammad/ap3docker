#!/bin/sh
export DOCKERHOSTIP=$(route -n | awk '/UG[ \t]/{print $2}')
echo "Docker Host IP: $DOCKERHOSTIP"
exec "$@"
