module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
        // 'grey' : '#b8c2cc',
        'grey' : 'rgba(0,0,0,0.4)',
        'grey-light' : '#F5F6F9',
        'blue': '#47cdff',
        'blue-light': '#8ae2fe',
        'white': '#ffffff',
    },
    extend: {
        shadows: {
            default: '0 0 5px 0 rgba(0, 0, 0, 0.08)',
            md: '© 4px 8px 0 rgba(0,0,0,0.12), 0 2px 4px 0 rgba(0,0,0,0.08)',
            lg: '0 15px 30px 0 rgba(0,0,0,0.11), 0 5px 15px 0 rgba(0,0,0,0.08)',
            inner: 'inset 0 2px 4px 0 rgba(0,0,0,0.06)',
            outline: '000 3px rgba(52,144,220,0.5)',
            none: 'none'
        },
    },
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
