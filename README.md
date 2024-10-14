# Job Application Exercise - Senior Profile

This repository contains the boilerplate for an application specifically
designed to test your abilities as a **senior** web developer. This README
contains instructions to get you started and details what you are expected
to do.

You should keep an eye out for the following icons:
- 🎯 designates a **primary** objective that you *MUST* complete.
- 🧠 designates a **bonus** objective that you *CAN* complete.
- 💡 designates a **hint** that may provide additional help.
- 🟢 designates a **test** command that can be run to validate your implementation.


## 🚨 Disclaimer Against AI Usage in this Technical Test

While completing this technical test, please refrain from using Artificial Intelligence (AI) assistance or language model generation tools (such as ChatGPT, Copilot, or similar technologies).

Although we encourage innovation and creative problem solving, using AI to code, design, or draft responses obscures the candidate's expertise and skills required for this position.

If evidence suggests that AI-generated materials contributed substantially to your submission, the test results may be deemed invalid, leading to unfavorable consequences for your candidacy.

## Context

One of your colleagues has started to write an API for managing movies; alas,
he's fallen ill and could not complete the job. Your boss has asked you to take
over. On the plus side, much of the boilerplate code has already been done, so
you'll only have to fill in the missing parts.

## Prerequisites

[Laravel Sail] is used to provide a basic development environment. You'll have
to install [Docker Desktop] on your machine since it depends on it.

## Getting started

The following steps will ensure that everything is ready for you to start the
exercise. Open up your favorite terminal emulator and follow along.

1. Clone this repository

2. Change into the project's directory
    ```
    cd /path/to/repository
    ```

3. Add the `sail` alias to your shell
    ```shell
    # if you use bash
    echo "alias sail='bash vendor/bin/sail'" >> ~/.bashrc && source ~/.bashrc

    # if you use zsh
    echo "alias sail='bash vendor/bin/sail'" >> ~/.zshrc && source ~/.zshrc
    ```

4. Run the bootstrapping script
    ```shell
    bash bootstrap.sh
    ```

5. Ensure that the application is running. This command should print *pong*
    ```
    curl http://localhost/ping
    ```

## Objectives

This section lists the objectives of this exercise. You are expected to complete
them in the order they are displayed.

> 💡 Do not hesitate to run the test commands while implementing these objectives, as
> it will help you to make sure that everything is working as intended. If a test
> is failing, but you are convinced that your implementation is correct, don't
> worry about it; the code will still be reviewed and tested manually.

1. [Bob the Schema Builder](docs/bob-the-schema-builder.md)
2. [All your movies are belong to us](docs/all-your-movies-are-belong-to-us.md)
3. [REST in peace](docs/rest-in-peace.md)
4. [Why are you so hardcoded ?](docs/why-are-you-so-hardcoded.md)
4. [Stuck in the Middle with You](docs/stuck-in-the-middle-with-you.md)
5. [Put your thumbs up](docs/put-your-thumbs-up.md)

### Bonus objectives 🧠

> ⚠️ Make sure to complete the primary objectives before starting on these.

You are not required to complete the following objectives, but you can take a
look at them if you have a free time on your hands.

1. [Sort this out](docs/sort-this-out.md)
2. [Validate my movie](docs/validate-my-movie.md)
3. [Put the review to REST](docs/put-the-review-to-rest.md)

[Laravel Sail]: https://laravel.com/docs/10.x/sail
[Docker Desktop]: https://docs.docker.com/docker-for-mac/install/

## Time Tracking with Wakatime

You can use [Wakatime](https://wakatime.com/) to share how you spent your time working on the exercise.

Please note that this is purely for informational purposes, and we won't award any extra points based on your time.
It's a tool to help you track your progress and give us more insights.
