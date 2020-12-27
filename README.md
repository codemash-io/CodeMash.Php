# CodeMash.Php

Php SDK for CodeMash

## Testing

### Unit tests

1. Run: `composer install`
2. Run: `compoer run-script unit-tests`

### Feature tests

1. Run: `composer install`
2. Copy file `phpunit_feature.xml.dist` to `phpunit_feature.xml`
3. CodeMash Cloud setup:
    - Create a test Project
    - Enable all Modules for the Project
    - Create a Collection. The schema **must** consist of these fields:
        - `title` - text
        - `email` - text
        - `address` - text
        - `file` - file
    - Create a Taxonomy and at least one Term for it
    - Edit the Users Meta Template schema to include this field:
        - `user_file` - file type
    - Create a new test Function in the Code module
    - Create a test Push Notification Template
4. Fill in CodeMash API environment variables in `phpunit_feature.xml` file:
    - `CODEMASH_API_SECRET_KEY`
    - `CODEMASH_API_PROJECT_ID`
    - `CODEMASH_API_TEST_COLLECTION_TITLE`
    - `CODEMASH_API_TEST_TAXONOMY_TITLE`
    - `CODEMASH_API_TEST_FUNCTION_ID`
    - `CODEMASH_API_TEST_EMAIL_TEMPLATE_ID`
    - `CODEMASH_API_TEST_PUSH_NOTIFICATION_TEMPLATE_ID`
5. Run: `compoer run-script feature-tests`
