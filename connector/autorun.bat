@echo off
cls
:start
call %CD%\hub4com\com2tcp --telnet \\.\COM7 5678

pause