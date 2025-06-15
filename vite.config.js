import {defineConfig} from "vite";
import {globSync} from "glob";
import * as fs from "fs";

export default defineConfig({
  base: "/wp-content/themes/portfolio/dist/",
  plugins: [
    {
      name: "bundle.js",
      buildStart() {
        // Récupère tous les fichiers JS dans le répertoire spécifié
        const files = globSync("./wp-content/themes/portfolio/src/js/app/**/*.js");

        // Fusionner tous les fichiers JS en un seul
        const combinedJS = files.map(file => fs.readFileSync(file, "utf-8")).join("\n");

        // Crée le fichier combiné dans le dossier de sortie
        fs.writeFileSync("./wp-content/themes/portfolio/src/js/main.js", combinedJS);
      },
    },
  ],
  build: {
    manifest: true,
    rollupOptions: {
      input: {
        js: "./wp-content/themes/portfolio/src/js/main.js",
        css: "./wp-content/themes/portfolio/src/css/style.scss",
      },
      output: {
        dir: "./wp-content/themes/portfolio/dist",
      },
    },
    assetsInlineLimit: 0,
    target: ["es2015"], // Rendre compatible le JAVASCRIPT
  },
});
