# Roles :
* CUSTOM DIRECTIVES :
    `@admin` : test if user is auhtentificated as an employee and has role 'admin'
    `@role([role1, role2...])` : test if user has any of the roles in the parameter array 
* GUARDS AND PROVIDERS:
    In order to have two different connexion variants ('client' and 'employe') we needed a second provider and guard
    To test if user is authentificated as an employee, do : `Auth::guard('employe')->check()`
    To test if user is authentificated as a client, simply use `Auth::check()`, as 'client' is the default guard
* MIDDLEWARES :
    We added a 'role' middleware that useful for assigning routes to certain roles
    For example, use : `Route::middleware(['role:service comm'])->group(function () { ... });`
    to allow certain routes only for 'service comm' employees