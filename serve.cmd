@echo off
cd /d "%~dp0"
echo Iniciando Sochagota en http://127.0.0.1:8000  (Ctrl+C para detener)
echo Registro: http://127.0.0.1:8000/registro
".tools\php\php.exe" artisan serve
