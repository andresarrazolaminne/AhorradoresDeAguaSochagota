@echo off
cd /d "%~dp0"
".tools\php\php.exe" ".tools\composer.phar" %*
