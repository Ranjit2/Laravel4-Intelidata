@echo OFF
TITLE Script by Mazebeat

:MENU
echo Se encuentra ubicado en la raiz del proyecto?  [Si, No, Salir]
set /p resp=
if %resp%==Si goto YES_ROOT
if %resp%==S goto YES_ROOT
if %resp%==s goto YES_ROOT
if %resp%==No goto NO_ROOT
if %resp%==N goto NO_ROOT
if %resp%==n goto NO_ROOT
if %resp%==Salir goto SALIR

:NO_ROOT
cls
echo Ingrese la ruta del proyecto? 
set /p root=
cd %root%
cd "app\storage"
del /S /Q "cache\*.*"
del /S /Q "debugbar\*.*"
del /S /Q "logs\*.*"
del /S /Q "meta\*.*"
del /S /Q "sessions\*.*"
del /S /Q "views\*.*"
cls
echo Archivos borrados
pause
goto MENU

:YES_ROOT
cls
cd "app\storage"
del /S /Q "cache\*.*"
del /S /Q "debugbar\*.*"
del /S /Q "logs\*.*"
del /S /Q "meta\*.*"
del /S /Q "sessions\*.*"
del /S /Q "views\*.*"
cls
echo Archivos borrados
pause
goto MENU

:SALIR
cls
echo Adios!!!!
pause
exit