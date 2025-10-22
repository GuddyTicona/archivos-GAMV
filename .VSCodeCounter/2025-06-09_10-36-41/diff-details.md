# Diff Details

Date : 2025-06-09 10:36:41

Directory c:\\xampp\\htdocs\\sisarchivo\\app\\Http\\Controllers

Total : 66 files,  -3147 codes, 137 comments, -238 blanks, all -3248 lines

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details

## Files
| filename | language | code | comment | blank | total |
| :--- | :--- | ---: | ---: | ---: | ---: |
| [app/Http/Controllers/AdminController.php](/app/Http/Controllers/AdminController.php) | PHP | 28 | 1 | 8 | 37 |
| [app/Http/Controllers/ArchivoController.php](/app/Http/Controllers/ArchivoController.php) | PHP | 71 | 20 | 22 | 113 |
| [app/Http/Controllers/Auth/ConfirmPasswordController.php](/app/Http/Controllers/Auth/ConfirmPasswordController.php) | PHP | 13 | 20 | 7 | 40 |
| [app/Http/Controllers/Auth/ForgotPasswordController.php](/app/Http/Controllers/Auth/ForgotPasswordController.php) | PHP | 8 | 10 | 5 | 23 |
| [app/Http/Controllers/Auth/LoginController.php](/app/Http/Controllers/Auth/LoginController.php) | PHP | 30 | 4 | 7 | 41 |
| [app/Http/Controllers/Auth/RegisterController.php](/app/Http/Controllers/Auth/RegisterController.php) | PHP | 38 | 0 | 10 | 48 |
| [app/Http/Controllers/Auth/ResetPasswordController.php](/app/Http/Controllers/Auth/ResetPasswordController.php) | PHP | 9 | 15 | 6 | 30 |
| [app/Http/Controllers/Auth/TwoFactorController.php](/app/Http/Controllers/Auth/TwoFactorController.php) | PHP | 37 | 17 | 13 | 67 |
| [app/Http/Controllers/Auth/VerificationController.php](/app/Http/Controllers/Auth/VerificationController.php) | PHP | 15 | 20 | 7 | 42 |
| [app/Http/Controllers/CategoriaController.php](/app/Http/Controllers/CategoriaController.php) | PHP | 50 | 18 | 17 | 85 |
| [app/Http/Controllers/ChatController.php](/app/Http/Controllers/ChatController.php) | PHP | 26 | 2 | 8 | 36 |
| [app/Http/Controllers/Controller.php](/app/Http/Controllers/Controller.php) | PHP | 9 | 0 | 4 | 13 |
| [app/Http/Controllers/FileAssistantController.php](/app/Http/Controllers/FileAssistantController.php) | PHP | 116 | 10 | 18 | 144 |
| [app/Http/Controllers/FinancieraController.php](/app/Http/Controllers/FinancieraController.php) | PHP | 91 | 0 | 15 | 106 |
| [app/Http/Controllers/HistorialArchivoController.php](/app/Http/Controllers/HistorialArchivoController.php) | PHP | 73 | 0 | 17 | 90 |
| [app/Http/Controllers/HomeController.php](/app/Http/Controllers/HomeController.php) | PHP | 10 | 10 | 6 | 26 |
| [app/Http/Controllers/ProfileController.php](/app/Http/Controllers/ProfileController.php) | PHP | 37 | 0 | 12 | 49 |
| [app/Http/Controllers/UnidadController.php](/app/Http/Controllers/UnidadController.php) | PHP | 55 | 3 | 13 | 71 |
| [app/Http/Controllers/UserController.php](/app/Http/Controllers/UserController.php) | PHP | 55 | 3 | 16 | 74 |
| [resources/views/archivo/create.blade.php](/resources/views/archivo/create.blade.php) | PHP | -19 | 0 | -7 | -26 |
| [resources/views/archivo/edit.blade.php](/resources/views/archivo/edit.blade.php) | PHP | -21 | 0 | -6 | -27 |
| [resources/views/archivo/form.blade.php](/resources/views/archivo/form.blade.php) | PHP | -106 | 0 | -7 | -113 |
| [resources/views/archivo/index.blade.php](/resources/views/archivo/index.blade.php) | PHP | -178 | 0 | -4 | -182 |
| [resources/views/archivo/show.blade.php](/resources/views/archivo/show.blade.php) | PHP | -65 | 0 | -6 | -71 |
| [resources/views/assistent/assistent.blade.php](/resources/views/assistent/assistent.blade.php) | PHP | -289 | -13 | -41 | -343 |
| [resources/views/auth/2fa.blade.php](/resources/views/auth/2fa.blade.php) | PHP | -43 | 0 | 0 | -43 |
| [resources/views/auth/login.blade.php](/resources/views/auth/login.blade.php) | PHP | -96 | 0 | -19 | -115 |
| [resources/views/auth/passwords/confirm.blade.php](/resources/views/auth/passwords/confirm.blade.php) | PHP | -41 | 0 | -9 | -50 |
| [resources/views/auth/passwords/email.blade.php](/resources/views/auth/passwords/email.blade.php) | PHP | -40 | 0 | -8 | -48 |
| [resources/views/auth/passwords/reset.blade.php](/resources/views/auth/passwords/reset.blade.php) | PHP | -53 | 0 | -13 | -66 |
| [resources/views/auth/register.blade.php](/resources/views/auth/register.blade.php) | PHP | -84 | 0 | -15 | -99 |
| [resources/views/auth/twoFactor.blade.php](/resources/views/auth/twoFactor.blade.php) | PHP | -54 | 0 | -3 | -57 |
| [resources/views/auth/verify.blade.php](/resources/views/auth/verify.blade.php) | PHP | -25 | 0 | -4 | -29 |
| [resources/views/categoria/create.blade.php](/resources/views/categoria/create.blade.php) | PHP | -20 | 0 | -5 | -25 |
| [resources/views/categoria/edit.blade.php](/resources/views/categoria/edit.blade.php) | PHP | -21 | 0 | -6 | -27 |
| [resources/views/categoria/form.blade.php](/resources/views/categoria/form.blade.php) | PHP | -18 | 0 | -2 | -20 |
| [resources/views/categoria/index.blade.php](/resources/views/categoria/index.blade.php) | PHP | -125 | 0 | -12 | -137 |
| [resources/views/categoria/show.blade.php](/resources/views/categoria/show.blade.php) | PHP | -29 | 0 | -5 | -34 |
| [resources/views/components/chat.blade.php](/resources/views/components/chat.blade.php) | PHP | -215 | -3 | -32 | -250 |
| [resources/views/dashboard.blade.php](/resources/views/dashboard.blade.php) | PHP | -11 | 0 | -1 | -12 |
| [resources/views/financiera/create.blade.php](/resources/views/financiera/create.blade.php) | PHP | -20 | 0 | -7 | -27 |
| [resources/views/financiera/edit.blade.php](/resources/views/financiera/edit.blade.php) | PHP | -21 | 0 | -6 | -27 |
| [resources/views/financiera/form.blade.php](/resources/views/financiera/form.blade.php) | PHP | -154 | 0 | -5 | -159 |
| [resources/views/financiera/index.blade.php](/resources/views/financiera/index.blade.php) | PHP | -192 | 0 | -9 | -201 |
| [resources/views/financiera/show.blade.php](/resources/views/financiera/show.blade.php) | PHP | -81 | 0 | -7 | -88 |
| [resources/views/google2fa/index.blade.php](/resources/views/google2fa/index.blade.php) | PHP | -27 | 0 | -2 | -29 |
| [resources/views/google2fa/register.blade.php](/resources/views/google2fa/register.blade.php) | PHP | -23 | 0 | -2 | -25 |
| [resources/views/historial-archivo/create.blade.php](/resources/views/historial-archivo/create.blade.php) | PHP | -20 | 0 | -7 | -27 |
| [resources/views/historial-archivo/edit.blade.php](/resources/views/historial-archivo/edit.blade.php) | PHP | -21 | 0 | -5 | -26 |
| [resources/views/historial-archivo/form.blade.php](/resources/views/historial-archivo/form.blade.php) | PHP | -73 | 0 | -5 | -78 |
| [resources/views/historial-archivo/index.blade.php](/resources/views/historial-archivo/index.blade.php) | PHP | -174 | 0 | -8 | -182 |
| [resources/views/historial-archivo/show.blade.php](/resources/views/historial-archivo/show.blade.php) | PHP | -45 | 0 | -5 | -50 |
| [resources/views/home.blade.php](/resources/views/home.blade.php) | PHP | -26 | 0 | -4 | -30 |
| [resources/views/index.blade.php](/resources/views/index.blade.php) | PHP | -174 | 0 | -13 | -187 |
| [resources/views/layouts/admin.blade.php](/resources/views/layouts/admin.blade.php) | PHP | -424 | 0 | -36 | -460 |
| [resources/views/layouts/app.blade.php](/resources/views/layouts/app.blade.php) | PHP | -76 | 0 | -19 | -95 |
| [resources/views/unidades/create.blade.php](/resources/views/unidades/create.blade.php) | PHP | -64 | 0 | -11 | -75 |
| [resources/views/unidades/edit.blade.php](/resources/views/unidades/edit.blade.php) | PHP | -53 | 0 | -10 | -63 |
| [resources/views/unidades/index.blade.php](/resources/views/unidades/index.blade.php) | PHP | -121 | 0 | -17 | -138 |
| [resources/views/unidades/show.blade.php](/resources/views/unidades/show.blade.php) | PHP | -49 | 0 | -12 | -61 |
| [resources/views/usuarios/create.blade.php](/resources/views/usuarios/create.blade.php) | PHP | -20 | 0 | -6 | -26 |
| [resources/views/usuarios/edit.blade.php](/resources/views/usuarios/edit.blade.php) | PHP | -21 | 0 | -6 | -27 |
| [resources/views/usuarios/form.blade.php](/resources/views/usuarios/form.blade.php) | PHP | -54 | 0 | -11 | -65 |
| [resources/views/usuarios/index.blade.php](/resources/views/usuarios/index.blade.php) | PHP | -125 | 0 | -18 | -143 |
| [resources/views/usuarios/show.blade.php](/resources/views/usuarios/show.blade.php) | PHP | -37 | 0 | -5 | -42 |
| [resources/views/welcome.blade.php](/resources/views/welcome.blade.php) | PHP | -270 | 0 | -8 | -278 |

[Summary](results.md) / [Details](details.md) / [Diff Summary](diff.md) / Diff Details