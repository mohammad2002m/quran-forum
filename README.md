## ملتقى القرآن الكريم


# Validations

Validations are seperated in traits, each function in the trait must return a ['status' , 'message']
'status' : must be either 'failed' or 'passed'
'message' : message of success or failure. it's not always used

if flash messages we use 
    'error': for error messages
    'success': for success messages
    
An Exception to that ForgotPassword Validation and that's because we use Password::SendResetLink 
it's return value it the validation and it sends the rest link and I don't know how they could be seperated

Another Excpetion is ResetPassword for similar reason, because of using Password::rest, it validates and changes the password and be called once
