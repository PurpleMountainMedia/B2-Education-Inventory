const ERROR_MESSAGE = 'Oops, there was a problem saving the data.';
const VALIDATION_ERROR_MESSAGE = 'Please fill in the required fields above.';
const SUCCESS_MESSAGE = 'Data saved successfully.';

export default {

    /**
     * Get and format the validation messages from the form.
     *
     * @param errors
     * @return Array
     */
    getValidationMessages(errors = {})
    {
        var validationMessages = [];
        for (var error in errors) {
            if (errors[error]) {
                validationMessages.push([errors[error][0] ? errors[error][0].message : '']);
            }
        }
        return validationMessages;
    },

    /**
     * Return the error message if issues saving the data.
     *
     * @return String
     */
    getErrorMessage()
    {
        return ERROR_MESSAGE;
    },

    /**
     * Return the validation error message if validation fails.
     *
     * @return String
     */
    getValidationErrorMessage()
    {
        return VALIDATION_ERROR_MESSAGE;
    },

    /**
     * Return the success message if data saved successfully.
     *
     * @return String
     */
    getSuccessMessage()
    {
        return SUCCESS_MESSAGE;
    }
}
