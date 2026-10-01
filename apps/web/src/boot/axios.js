import { defineBoot } from '#q-app';
import axios from 'axios'
import { Notify } from 'quasar'

const getToken = () => {
  return '4|5XWSF70peg18ptTV6FRwx3KlD9MHeovu31Y82B0P00fbc82f';
}

const api = axios.create({ baseURL: import.meta.env.QCLI_API_URL })

api.interceptors.request.use((config) => {
  const token = getToken()
  if (token && token.length > 10) {
    config.headers.Authorization = `Bearer ${token}`;
  }

  return config;
}, (error) => Promise.reject(error));

api.interceptors.response.use((response) => response, (error) => {
  const { code } = error?.response?.data ?? {}

  if (code) {
    Notify.create({
      message: code,
      type: 'negative',
    })
  }

  return Promise.reject(error)
})

export default defineBoot(({ app }) => {
  app.config.globalProperties.$axios = axios
  app.config.globalProperties.$api = api
})

export { api }
