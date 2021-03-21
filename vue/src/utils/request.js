import axios from 'axios'
import {ToastNotification} from '@/components/Notifications'

// create an axios instance
const service = axios.create({
	// baseURL: process.env.VUE_APP_BASE_API, // url = base url + request url
	baseURL: process.env.VUE_APP_BASE_API,
	// withCredentials: true, // send cookies when cross-domain requests
	timeout: 5000 // request timeout
})


// response interceptor
service.interceptors.response.use(
		response => {
			const res = response

			// Set Alert response if exist
			if (_.has(res.data, 'alert')) {
				store.dispatch('app/setAlert', res.data.alert)
			}

			// Set message response if exist
			if (_.has(res.data, 'message')) {
				let message = ''

				if ((typeof res.data.message) === 'string') {
					message = res.data.message
				} else if ((typeof res.data.message) === 'object') {
					message = response.data.message.title
					message += res.data.message.description ? '<br>' + res.data.message.description : ''
				}
				//
				new ToastNotification({
					message: message,
					type: res.data.message.type,
					duration: 5 * 1000,
					autoplay: true
				})
			}

			// store.dispatch('responseSuccess', response)

			return response
		},
		error => {
			let message = ''
			const res = error.response

			console.log(res) // Detail

			if (res) {
				if ((typeof res.data.message) === 'string' && res.data.message !== '') {
					message = res.data.message
				} else if ((typeof res.data.message) === 'object') {
					message += res.data.message.title
					message += res.data.message.description ? '<br>' + res.data.message.description : ''
				} else if (res.data.exception) {
					message += res.data.exception
					message += '<br>' + res.data.file
				}
			} else {
				message = error.message
			}

			if (message) {
				new ToastNotification({
					message: message,
					type: ToastNotification.type.error,
					autoplay: true
				})
			}

			return Promise.reject(error)
		}
)

export default service