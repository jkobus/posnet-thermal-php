@echo off
cls
set /p tcp=Podaj numer portu TCP (np. 5678):  
set /p com=Podaj nazwe portu COM (np. COM7):  

echo Jesli uzywasz modulu bluetooth, po polaczeniu dioda na drukarce powinna sie swiecic.
echo .
echo Wcisnij cokolwiek aby kontynuowac.
echo .

pause >> nul

start %CD%\hub4com\com2tcp --baud 9600 --data 8 --telnet \\.\%com% %tcp%