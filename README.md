## !! This is a UNDER DEVELOPMENT project !!
# Email-Random-XKCD 
It is a simple PHP application that accepts a visitor’s email address and emails them random XKCD comics every five minutes.
# Email Verification
In order to avoid visitor from using other person's credentials an email verification process is developed.
# 1. New user Signup ---> (Signup_Page.php)
Once anyone visits this page he/she has to register using a mail id and a password. After entering all the details hit signup. A verification link will hit on your REGISTERED EMAIL ID. This link is nothing but a random token generated by a signup page. This link will redirect you to the Login page.
# 2. User Login ---> (Login_Page.php)
After successful email verification user can login via the redirected page using his registered details. User can visit anytime to login into is account using valid credentials via a **login link provided on signup page.**
# 3. User Logout (Session Destroy) ---> (Logout_Page.php)
If user wants to close the session he can press Logout button on his currect session to log out out from all the sessions. User can revisit again anytime.
# 4. Subscribe to XKCD comic (Under Development)
This the home page for the user from where he can subscribe to XKCD comics to get a random XKCD image on his mail id at specified time interval(5 mins)
# 5. Unsubscribe to XKCD comic (Under Development)
If user wants to stop reveiving mails he can hit unsubscribe button on his homepage to stop reveiving mail.
 
