export default ({ store, redirect }) => {
  if (!store.getters['auth/check']) {
    return redirect('/login')
  }

  if (store.getters['auth/role'] == 'admin') {
    return redirect('/admin')
  }

}
