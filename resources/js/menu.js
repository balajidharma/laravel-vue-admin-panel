import {
  mdiAccountCircle,
  mdiMonitor,
  mdiGithub,
  mdiLock,
  mdiAlertCircle,
  mdiSquareEditOutline,
  mdiTable,
  mdiViewList,
  mdiTelevisionGuide,
  mdiResponsive,
  mdiPalette
} from '@mdi/js'

export default [
  {
    route: 'dashboard',
    icon: mdiMonitor,
    label: 'Dashboard'
  },
  {
    route: 'permission.index',
    icon: mdiMonitor,
    label: 'Permissions'
  },
  {
    href: 'https://github.com/balajidharma/laravel-vue-admin-panel',
    label: 'GitHub',
    icon: mdiGithub,
    target: '_blank'
  }
]
