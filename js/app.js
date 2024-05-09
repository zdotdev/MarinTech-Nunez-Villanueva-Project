import express from 'express'
import mongoose from 'mongoose'
import cors from 'cors'
import router from '../routes/routes.js'

const app = express()
const PORT = 3000
app.use(express.json())
app.use(cors())
app.use('/api', router)

mongoose
  .connect(
    'mongodb+srv://admin:admin@accounts.0uj52x6.mongodb.net/?retryWrites=true&w=majority&appName=accounts'
  )
  .then(() => {
    app.listen(PORT)
  })
  .then(() => {
    console.log('Conectado')
  })
  .catch(err => {
    console.log(err)
  })
