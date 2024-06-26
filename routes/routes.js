import express from 'express'
import {
  getAllUser,
  getById,
  getByIdAndDelete,
  login,
  signup
} from '../controller/controller.js'

const router = express.Router()

router.get('/', getAllUser)
router.get('/:id', getById)
router.post('/signup', signup)
router.post('/login', login)
router.delete('/:id', getByIdAndDelete)

export default router
