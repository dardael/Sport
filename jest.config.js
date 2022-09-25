/** @type {import('ts-jest').JestConfigWithTsJest} */
module.exports = {
  preset: 'ts-jest',
  testEnvironment: 'node',
  transform: {
    "^.+\\.ts?$": "ts-jest",
  },
  testRegex: "(/tests/Front/.*|(\\.|/)(test|spec))\\.(jsx?|tsx?)$",
};
