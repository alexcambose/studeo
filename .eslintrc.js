module.exports = {
    "env": {
        "browser": true,
        "node": true,
        "es6": true
    },
    "plugins": [
        "html"
    ],
    "extends": "google",
    "parserOptions": {
        "sourceType": "module",
        "ecmaVersion": 6,
        "ecmaFeatures": {
            "experimentalObjectRestSpread": true
        }
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
        ],
        "max-len": "off",
        "space-before-function-paren": "off",
        "object-curly-spacing": ["error", "always"],
        "arrow-parens": ["error", "as-needed"],
    },
    "globals": {
        "axios": false,
        "var2": false,
        "moment": false,
    }
};