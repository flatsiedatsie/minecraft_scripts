#!/bin/bash


BOOT_DIR="/boot"
if lsblk | grep -q $BOOT_DIR/firmware; then
    #echo "firmware partition is mounted at $BOOT_DIR/firmware"
    BOOT_DIR="$BOOT_DIR/firmware"
fi

LOCAL_IP=`sudo hostname -I`
echo "LOCAL_IP=$LOCAL_IP"
DATA="password=REDACTED_PASSWORD&local_ip=$LOCAL_IP"
#echo $DATA
curl --data "$DATA&state=STARTED" https://minecraft.REDACTED_SERVER/save.php
sleep 1

if [ -f "$BOOT_DIR/reset.txt" ]
then
    rm -rf /home/pi/minecraft/world -y
    rm "$BOOT_DIR/reset.txt" -y
fi


rm home/pi/minecraft/plugins/WorldEdit/schematics/._*


echo "STARTING FUNKY SERVER"
cd /home/pi/minecraft

totalk=$(awk '/^MemTotal:/{print $2}' /proc/meminfo)
#logger total memory: $totalk

echo "TOTAL MEMORY: $totalk"

if [ "$totalk" -lt 1500000 ]
then
   echo "LOW MEMORY"
   java -Xms512M -Xmx1008M -jar /home/pi/minecraft/server.jar nogui
else

  if [ "$totalk" -lt 2500000 ]
  then
   echo "MEDIUM  MEMORY"
   java -Xms512M -Xmx1512M -jar /home/pi/minecraft/server.jar nogui
  else
   echo "HIGH MEMORY"
   java -Xms1024M -Xmx3024M -jar /home/pi/minecraft/server.jar nogui
  fi

fi

echo "FUNKY SERVER STOPPED"

curl --data "$DATA&state=STOPPED" https://minecraft.REDACTED_SERVER/save.php
