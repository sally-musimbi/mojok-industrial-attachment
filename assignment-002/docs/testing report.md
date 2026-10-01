# Testing Report

## 1. Navigation Testing

| Test | Result |
|---|---|
| Home link | Passed |
| About Us link | Passed |
| Services link | Passed |
| Portfolio link | Passed |
| Contact link | Passed |
| Footer navigation | Passed |

## 2. Responsive Testing

| Page | Desktop | Mobile | Result |
|---|---|---|---|
| Home | Tested | Tested | Passed |
| About Us | Tested | Tested | Passed |
| Services | Tested | Tested | Passed |
| Portfolio | Tested | Tested | Passed |
| Contact | Tested | Tested | Passed |

No sideways scrolling was observed on the tested mobile layouts.

## 3. JavaScript Testing

| Feature | Result |
|---|---|
| Mobile navigation menu | Passed |
| Back-to-top button | Passed |
| Dynamic copyright year | Passed |
| Contact form validation | Passed |

## 4. Contact Form Testing

### Empty Fields
Leaving the required fields empty displays validation messages.

### Invalid Email
An invalid email such as `abc` displays:
"Please enter a valid email address."

### Valid Submission
A valid email and completed form displays the success message:
"Thank you! Your message has been submitted successfully."

## 5. Browser Console Testing

A JavaScript syntax error was identified during testing and corrected. The Console was tested again and the error was no longer present.

## 6. Visual Testing

- Text was checked for spelling and readability.
- Buttons and navigation links were tested.
- Layouts were checked on mobile and desktop.
- Form controls were checked for proper styling.
- Hover effects were implemented for interactive elements.

## 7. Known Limitation

The contact form is client-side only and does not send data to a backend server.

## Conclusion

The website was tested for navigation, responsiveness, JavaScript interactions, contact form validation, and visual presentation. The identified JavaScript and responsive-layout issues were corrected.
