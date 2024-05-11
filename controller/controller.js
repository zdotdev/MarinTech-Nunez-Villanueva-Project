import User from '../model/model.js'

export const getAllUser = async (req, res) => {
  let users

  try {
    users = await User.find()
  } catch (err) {
    console.log(err)
  }

  if (!users) {
    return res.status(404).json({ message: 'No user' })
  }
  return res.status(200).json({ users })
}

export const signup = async (req, res) => {
  const { name, email, password } = req.body
  let existingUser

  try {
    existingUser = await User.findOne({ email })
  } catch (err) {
    return console.log(err)
  }

  if (existingUser) {
    return res.status(400).json({ message: 'Existing User' })
  }

  const user = new User({
    name,
    email,
    password
  })

  try {
    await user.save()
  } catch (err) {
    return console.log(err)
  }
  return res
    .status(201)
    .json({ id: user._id, message: 'Sign up successful', status: 201 })
}

export const login = async (req, res) => {
  const { email, password } = req.body

  let existingUser

  try {
    existingUser = await User.findOne({ email })
  } catch (err) {
    return console.log(err)
  }
  if (!existingUser) {
    return res.status(404).json({ message: "Can't find the user" })
  }

  const passwordIsCorrect = existingUser.password === password

  if (!passwordIsCorrect) {
    return res.status(400).json({ message: 'Incorrect password' })
  }
  return res
    .status(200)
    .json({ message: 'Login successful', id: existingUser._id })
}
