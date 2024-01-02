#!/bin/bash
while read p; do
    php novoBonusManual.php $p'&gera_bonus=1'
    sleep 1;
done < $1.txt