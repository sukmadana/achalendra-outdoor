import axios from 'axios'
import Swal from 'sweetalert2'

// process.env.NODE_TLS_REJECT_UNAUTHORIZED = '0'

export default ({ app, store, redirect }) => {
  axios.defaults.baseURL = process.env.apiUrl

  if (process.server) {
    return
  }

  // Request interceptor
  axios.interceptors.request.use((request) => {
    request.baseURL = process.env.apiUrl
    request.headers.common['Content-Type'] = 'multipart/form-data'

    const token = store.getters['auth/token']

    if (token) {
      request.headers.common.Authorization = `Bearer ${token}`
    }

    const locale = store.getters['lang/locale']
    if (locale) {
      request.headers.common['Accept-Language'] = locale
    }

    return request
  })

  // Response interceptor
  axios.interceptors.response.use(response => response, (error) => {
    const { status } = error.response || {}

    if (status >= 500) {
      Swal.fire({
        icon: 'error',
        title: app.i18n.t('error_alert_title'),
        text: app.i18n.t('error_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      })
    }

    if (status === 401 && store.getters['auth/check']) {
      Swal.fire({
        icon: 'warning',
        title: app.i18n.t('token_expired_alert_title'),
        text: app.i18n.t('token_expired_alert_text'),
        reverseButtons: true,
        confirmButtonText: app.i18n.t('ok'),
        cancelButtonText: app.i18n.t('cancel')
      }).then(() => {
        store.commit('auth/LOGOUT')

        redirect({ name: 'login' })
      })
    }

    return Promise.reject(error)
  })
}
