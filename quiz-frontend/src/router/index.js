import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '../components/LoginPage.vue'
import QuizView from '../components/QuizPage.vue'
import HomeView from '../components/HomePage.vue'
import RegisterView from '../components/RegisterPage.vue'
import ThankyouView from '../components/ThankyouPage.vue'
import ReportView from '../components/ReportPage.vue'

const routes = [
  {
    path: '/login',
    name: 'login',
    component: LoginView
  },
  {
    path: '/quiz',
    name: 'quiz',
    component: QuizView
  },
  {
    path: '/report',
    name: 'report',
    component: ReportView
  },
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/thankyou',
    name: 'thankyou',
    component: ThankyouView
  },
  {
    path: '/register',
    name: 'register',
    component: RegisterView
  }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

const isLoggedIn = () => {
  return localStorage.getItem('TOKEN')
}

const protectedRoutes = [
  "quiz",
  "thankyou",
]
router.beforeEach((to, from, next) => {
  const isProtected = protectedRoutes.includes(to.name)
  if(isProtected && !isLoggedIn()){
      next({
          path: '/login'
      })
  }else next()
})

export default router
