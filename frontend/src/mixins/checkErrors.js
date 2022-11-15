export default {
    methods: {
        checkError(errorResponse, errors) {
            if (errorResponse.response.data.errors) {
                Object.keys(errors).forEach((key) => {
                    if (errorResponse.response.data.errors[key]) {
                        errors[key] = errorResponse.response.data.errors[key][0]
                    } else {
                        errors[key] = null
                    }
                })
            }
        }
    }


}