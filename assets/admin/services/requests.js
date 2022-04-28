import axios from 'axios'
import user from '../store/modules/user'
import {store} from '../store/index'

// const apiClientJsonLd = axios.create({
//     withCredentials: false,
//     headers: {
//         Accept: 'application/ld+json',
//         'Content-type': 'application/ld+json',
//         Authorization: `Bearer ${localStorage.getItem('token')}`
//     }
// })


// const apiClientJson = axios.create({
//     withCredentials: false,
//     headers: {
//         Accept: 'application/json',
//         'Content-type': 'application/json',
//         Authorization: `Bearer ${localStorage.getItem('token')}`
//     }
// })

async function getTokenFromRefresh() {
    console.log('dans le refresh')
    const response =  await axios.post('/api/token/refresh', {
        'refresh_token' : localStorage.getItem('refresh')
    })
    localStorage.setItem('token', response.data.token)
    localStorage.setItem('refresh', response.data.refresh_token)
}

export default {
    async publicGetRequest(iri) {
        return  await axios.get(iri, {
            headers: {
                Accept: 'application/ld+json',
                'Content-type': 'application/ld+json',
                Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDkzMzY5MjYsImV4cCI6MzYxNjQ5MzM2OTI2LCJyb2xlcyI6WyJST0xFX0FETUlOIl0sInVzZXJuYW1lIjoiamVubmlmZXJAbW9uY29hY2hicmljby5jb20iLCJpcmkiOiIvYXBpL2FkbWluL3VzZXJzLzkifQ.XV-H46fwZHveQtkVX73fbq8QM444aibzKln2xX0yns2AzTM5ciN2iUCO18_cS8D4_2qgt9YEnK-dycJGEHHoIiUCoX9WjnxfWsNdJiEe44PH-LSrDvlV0XnaSO5OCSX4GtuTDasirTteTNtgrvA1KNWVAjoY5yuN3kr2EnL45LwfLkfgj1nieMNlc1VezEE9gLP2bQSaAWLIFsv20dGpJBc7Gh0AA2AAQA7LrZMEDApLaPLdUnPHe56fdKVx5bIs4-AfQIhGXEC7b5ryeQ0qLiA_8p64PeVOBzgVT_zCGGl5sRVwk6A03ZVIQlePszFFCMuOXZC_fgidSfQkJCBOJw'
            }
        })
    },
    async publicPutRequest(iri, value) {
        return await axios.put(iri, value,{
            headers: {
                Accept: 'application/ld+json',
                'Content-type': 'application/ld+json',
                Authorization: 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NDkzMzY5MjYsImV4cCI6MzYxNjQ5MzM2OTI2LCJyb2xlcyI6WyJST0xFX0FETUlOIl0sInVzZXJuYW1lIjoiamVubmlmZXJAbW9uY29hY2hicmljby5jb20iLCJpcmkiOiIvYXBpL2FkbWluL3VzZXJzLzkifQ.XV-H46fwZHveQtkVX73fbq8QM444aibzKln2xX0yns2AzTM5ciN2iUCO18_cS8D4_2qgt9YEnK-dycJGEHHoIiUCoX9WjnxfWsNdJiEe44PH-LSrDvlV0XnaSO5OCSX4GtuTDasirTteTNtgrvA1KNWVAjoY5yuN3kr2EnL45LwfLkfgj1nieMNlc1VezEE9gLP2bQSaAWLIFsv20dGpJBc7Gh0AA2AAQA7LrZMEDApLaPLdUnPHe56fdKVx5bIs4-AfQIhGXEC7b5ryeQ0qLiA_8p64PeVOBzgVT_zCGGl5sRVwk6A03ZVIQlePszFFCMuOXZC_fgidSfQkJCBOJw'
            }
        })
    },
    async getToken(credentials) {
        return await axios.post('/api/login_check', credentials)
    },
    async getDatas(iri) {
        return  await axios.get(iri, {
            headers: {
                Accept: 'application/ld+json',
                'Content-type': 'application/ld+json',
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }).catch(async function (error) {
            if (error.response.status === 401) {
                await getTokenFromRefresh()


                console.log('ici')
                // localStorage.removeItem('refresh')
                // localStorage.removeItem('token')


                return await this.getDatas(iri)
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                // console.log(error.response.data);

                // console.log(error.response.status);
                // console.log(error.response.headers);

                // TODO get token from refresh token


            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log('Error', error.message);
            }
        })
    },
    async postData(iri, value) {
        return await axios.post(iri, value,{
            headers: {
                Accept: 'application/ld+json',
                'Content-type': 'application/ld+json',
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }).catch(function (error) {
            console.log(error)
        })
    },
    async putData(iri, value) {
        return await axios.put(iri, value,{
            headers: {
                Accept: 'application/ld+json',
                'Content-type': 'application/ld+json',
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }).catch(function (error) {
            console.log(error)
        })
    },
    async patchData(iri, value) {
        return await axios.patch(iri, value,{
            headers: {
                Accept: 'application/json',
                'Content-type': 'application/json',
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        }).catch(function (error) {
            console.log(error.result)
            console.log(error)
        })
    },
}
