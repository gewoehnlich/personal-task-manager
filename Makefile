.PHONY = gemini

include .env
export

gemini:
	npx https://github.com/google-gemini/gemini-cli
