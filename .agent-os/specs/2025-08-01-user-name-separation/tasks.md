# Spec Tasks

## Tasks

- [ ] 1. Database Migration and Model Updates
  - [ ] 1.1 Write tests for User model with separated name fields
  - [ ] 1.2 Create database migration to drop name column and add first_name, middle_name, last_name, and suffix columns
  - [ ] 1.3 Update User model with new fillable fields and validation rules
  - [ ] 1.4 Implement full_name accessor method on User model
  - [ ] 1.5 Verify all tests pass

- [ ] 2. User Factory Updates
  - [ ] 2.1 Write tests for User factory with separated name generation
  - [ ] 2.2 Update User factory to generate first_name, middle_name, last_name, and suffix instead of name
  - [ ] 2.3 Ensure factory generates realistic name data with optional middle_name and suffix
  - [ ] 2.4 Verify all factory tests pass

- [ ] 3. Registration Form Updates
  - [ ] 3.1 Write tests for registration with separated name fields
  - [ ] 3.2 Update registration blade template to include separate input fields
  - [ ] 3.3 Update registration controller/request validation for new fields
  - [ ] 3.4 Update registration form styling for proper field layout
  - [ ] 3.5 Verify registration tests pass

- [ ] 4. User Profile Form Updates
  - [ ] 4.1 Write tests for profile editing with separated name fields
  - [ ] 4.2 Update profile edit blade template with separate name input fields
  - [ ] 4.3 Update profile controller/request validation for new fields
  - [ ] 4.4 Ensure proper display of current values in edit form
  - [ ] 4.5 Verify all profile editing tests pass

- [ ] 5. Final Integration Testing
  - [ ] 5.1 Run full test suite to ensure no regressions
  - [ ] 5.2 Manually test registration flow with various name combinations
  - [ ] 5.3 Manually test profile editing with name updates
  - [ ] 5.4 Verify proper display of full names throughout the application