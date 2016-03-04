@echo off
@echo you must set the php.exe to the path before you use pcss
set path_=%~dp0bin;
reg add "HKEY_LOCAL_MACHINE\SYSTEM\CurrentControlSet\Control\Session Manager\Environment" /v Path /t REG_EXPAND_SZ /d "%path%;%path_^%" /f
echo now you can use pcss argv1 argv2
echo argv1 is a file or a dir to watch
echo argv2 is a dir to output
