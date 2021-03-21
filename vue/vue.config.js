module.exports = {
  transpileDependencies: ['vuetify'],
  lintOnSave: false, // warning
  publicPath: process.env.NODE_ENV === 'production'
    ? '/spa/'
    : '/'
}
