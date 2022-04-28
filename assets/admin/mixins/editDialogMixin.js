import Requests from "@/services/requests";
import router from "@/router";

export default {
    data: function () {
        return {
            snack: false,
            snackColor: '',
            snackText: '',
            result: ''
        }
    },
    methods: {
        save(resource, newValue) {
            console.log(resource)
            console.log(newValue)
            Requests.patchData(resource, newValue)
                .then(function (response) {
                    console.log(response);
                })
            this.snack = true
            this.snackColor = 'success'
            this.snackText = 'Data saved'
        },
        async savePut(resource, newValue) {
            await Requests.putData(resource, newValue)
                .then(response => (this.result = response.status))
                .catch(function (error) {
                    this.result = error.status
                    if (error.response) {
                        // The request was made and the server responded with a status code
                        // that falls out of the range of 2xx
                        console.log(error.response.data);
                        console.log(error.response.status);
                        console.log(error.response.headers);
                    } else if (error.request) {
                        // The request was made but no response was received
                        // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                        // http.ClientRequest in node.js
                        console.log(error.request);
                    } else {
                        // Something happened in setting up the request that triggered an Error
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                    // return 'error'
                }).finally(() => {
                    if (this.result > 0 && this.result < 300) {
                        this.snackMessage('success', 'Changement sauvegardé')
                        this.result = ''
                        setTimeout(function () {
                            router.go(0)
                        }, 500);
                    } else {
                        this.snackMessage('danger', 'Une erreur est survenue')
                        this.result = ''
                        setTimeout(function () {
                            router.go(0)
                        }, 500);
                    }
                })
        },
        cancel() {
            this.snack = true
            this.snackColor = 'error'
            this.snackText = 'Canceled'
        },
        open() {
            this.snack = true
            this.snackColor = 'info'
            this.snackText = 'Dialog opened'
        },
        close() {
            console.log('Dialog closed')
        },
        snackMessage(type, message) {
            this.snack = true
            this.snackColor = type
            this.snackText = message
        }
    }
}
