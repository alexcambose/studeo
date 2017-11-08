module.exports = {
    "env": {
        "browser": true,
        "node": true,
        "es6": true
    },
    "extends": "eslint:recommended",
    "parserOptions": {
        "sourceType": "module"
    },
    "rules": {
        "indent": [
            "error",
            4
        ],
        "linebreak-style": "off",
        "quotes": [
            "error",
            "single"
        ],
        "no-console": "off",
        "semi": [
            "error",
            "always"
        ]
    },
    "globals": {
        "axios": false,
        "var2": false
    }
};