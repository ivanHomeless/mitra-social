export default {
    methods: {
        checkErrorResponse(responseErrors) {
            let errors = {}
            if (responseErrors.response && responseErrors.response.data.errors) {
                Object.keys(responseErrors.response.data.errors).forEach((errorName) => {
                    errors[errorName] = responseErrors.response.data.errors[errorName][0]
                })
            }
            return errors
        }
    }


}