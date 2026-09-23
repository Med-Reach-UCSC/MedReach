@echo off
setlocal
powershell -NoProfile -ExecutionPolicy Bypass -File "%~dp0apply.ps1"
echo.
echo Press any key to close this window...
pause >nul
endlocal
