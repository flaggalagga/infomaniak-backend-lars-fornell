var faker = require('./faker.min.js')

module.exports = () => {
    const data = { movies: [] }

    // Create 100 movies
    for (let i = 0; i < 100; i++) {
        data.movies.push({
            title: faker.lorem.words(),
            year: faker.datatype.datetime().getFullYear(),
            poster: faker.image.imageUrl(),
        })
    }
    return data
}
