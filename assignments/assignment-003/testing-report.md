# Assignment 003 Testing Report

## 1. Purpose

This report documents the planned tests for the PHP and MySQL dynamic website and admin dashboard.

## 2. Test Results

**Status key:** Not Run, Pass, Fail

| No. | Test case | Expected result | Status |
|---:|---|---|---|
| 1 | Open the home page | Page loads successfully | Not Run |
| 2 | Display services | Services are retrieved from the database | Not Run |
| 3 | Display portfolio projects | Projects are retrieved from the database | Not Run |
| 4 | Submit a valid enquiry | Enquiry is saved in the database | Not Run |
| 5 | Submit an empty enquiry form | Validation errors are displayed | Not Run |
| 6 | Submit an invalid email | Email validation rejects the input | Not Run |
| 7 | Log in with valid admin credentials | Admin dashboard opens | Not Run |
| 8 | Log in with an incorrect password | Login is rejected | Not Run |
| 9 | Log out of the admin dashboard | Session ends and protected pages require login | Not Run |
| 10 | Add a service | Service is saved and displayed | Not Run |
| 11 | Edit a service | Updated service details are saved | Not Run |
| 12 | Delete a service | Selected service is removed | Not Run |
| 13 | Add a portfolio project | Project is saved | Not Run |
| 14 | Edit a portfolio project | Updated project details are saved | Not Run |
| 15 | Delete a portfolio project | Selected project is removed | Not Run |
| 16 | Access an admin page without logging in | Access is denied or redirected to login | Not Run |
| 17 | Submit a form with an invalid CSRF token | Request is rejected | Not Run |
| 18 | Enter text containing HTML tags | Output is safely escaped | Not Run |

## 3. Testing Notes

- Run each test after implementing the relevant feature.
- Record the actual outcome and update the status.
- Document any failures and the corrective action taken.
- Do not mark a test as passed without verifying the result.

## 4. Conclusion

The tests will be performed as the website and admin dashboard are developed. The final report will summarize the verified results and any outstanding issues.
