<template>
  <div>
    <section v-html="JSON.parse($page.props.page.source).html"></section>
  </div>
</template>

<script>


  export default {
    props: ['page'],

    methods: {
      nodeScriptReplace(node) {
        if (this.nodeScriptIs(node) === true) {
          node.parentNode.replaceChild(this.nodeScriptClone(node), node);
        } else {
          let i = -1;
          const children = node.childNodes;
          while (++i < children.length) {
            this.nodeScriptReplace(children[i]);
          }
        }

        return node;
      },
      nodeScriptClone(node) {
        const script = document.createElement('script');
        script.text = node.innerHTML;

        let i = -1; const attrs = node.attributes;
        let attr;
        while (++i < attrs.length) {
          script.setAttribute((attr = attrs[i]).name, attr.value);
        }
        return script;
      },
      nodeScriptIs(node) {
        return node.tagName === 'SCRIPT';
      }
    },

    mounted() {
      const css = JSON.parse(this.$page.props.page.source).css;
      const head = document.head || document.getElementsByTagName('head')[0];
      const style = document.createElement('style');
      head.appendChild(style);
      style.appendChild(document.createTextNode(css));
      this.nodeScriptReplace(document.getElementsByTagName('body')[0]);
    }
  };
</script>
