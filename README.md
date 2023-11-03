# IE4717_DentalClinic
A full-stack web application using HTML, CSS, JS, PHP and MySQL

Welcome to our clinic!

QA:
1. What does hamburger navigation do in index.html? and toggleMenu() function associated with onclick in index.html?

2. In createaccount.html, why the input fields of re-type password is not aligned with other input fields?

3. how 'hidden' and 'visible' are implemented?

4. retype password and mobile phone number alignment???

5. client side manipulation. Deletion of required field in 'input' tag. Accidentally entered the websites that should not be accessible?

6. how to maintain the state of log in???

7. assume doctors have unique name(they cant have the same name)

8. implementation of logout button has been done and styling of logout button is left, styling of appointment and styling of appointment-details page!


TODO:

1. input validation for create new account:<br>a. the max(min) length of NAME and no illegal chars<BR>
b. provide guideline of password to users:
something like: 1. at least 8 chars, max of 100 chars 2. mix of upper and lower case chars 3. at least one number 4. at least one special char e.g. -!&+?/ with checkboxes indicated state assigned to onchange event listener
<br>
c. consistent password(check password and re-type password field)<br>
d. email validation. google to use robust validation method.<br>
e. phone validation google to find out the pattern of the sg phone number
<br>
f. retrieve from the database to make sure the phone number and emails entered are not linked with other accounts! use ajax if existed, alert linked with existing account and prevent default behaviour! Handle lower case and upper case of the emails!!!!
<BR>
g. sign in use ajax to compare email and password with database follow creat_account.js
h. handle the logic after login

doctor1:
Lee email:lee@tan.sons.com pwd:123456Aa/

doctor2:
Shawn email:shawn@tan.sons.com pwd:123456Aa/

doctor3:
Shanice email:shanice@tan.sons.com pwd:123456Aa/