# Contact Signup Plugin

## Description

The Contact Signup Plugin is a WordPress plugin that allows visitors to sign up to a contact list and lets the admin view the signed-up users' contact information as contact cards. This plugin includes a front-end page for the signup form, a custom Gutenberg block for displaying contact information, and an admin page for managing the contact list.

## Features

- **Front-end Signup Form**: A custom page at the `/sign-up` route where visitors can sign up with their contact information.
- **Gutenberg Block**: A custom block that allows users to select a signed-up person from the list and display their contact card.
- **Admin Page**: A React-based admin page to view and manage the contact list.

## Installation

1. **Download and Extract**: Download the plugin as a ZIP file and extract it.
2. **Upload to WordPress**: Upload the `contact-signup-plugin` folder to the `/wp-content/plugins/` directory.
3. **Activate the Plugin**: Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

### Front-end Signup Form

Navigate to the `/sign-up` route on your website to access the signup form. The form includes fields for Name, Address, Phone Number, Email, and Hobbies. The Hobbies field is a custom tag input allowing up to 3 hobbies.

### Gutenberg Block

1. In the Gutenberg editor, add the "Contact List" block.
2. Use the block's Inspector Controls to select a person from the list of signed-up users.
3. The selected person's contact card will be displayed in the editor.

### Admin Page

1. Access the admin page by navigating to the "Contact Signup" menu item in the WordPress admin dashboard.
2. The admin page displays a table of all signed-up users with their contact information.

## Development

### Prerequisites

- Node.js
- npm
- WordPress development environment

### Building Assets

This plugin uses Webpack to bundle JavaScript files. Run the following command to build the assets:

```sh
npm install
// For development builds
npm run dev
// For production builds
npm run prod
