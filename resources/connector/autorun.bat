@echo off
cls
:start
call %CD%\hub4com\com2tcp --telnet \\.\COM3 5333

pause