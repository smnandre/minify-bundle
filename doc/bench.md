# Benchmarks

## Setup

### Download files

```
curl -O https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/autoComplete.js
curl -O https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.js
curl -O https://cdn.jsdelivr.net/npm/video.js@8.18.1/dist/video.js
curl -O https://raw.githubusercontent.com/w3c/w3c-website-templates-bundle/refs/heads/main/public/dist/assets/js/main.js
curl -O https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.css
curl -O https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.css
curl -O https://cdn.jsdelivr.net/npm/video.js@8.18.1/dist/video-js.css
curl -O https://raw.githubusercontent.com/w3c/w3c-website-templates-bundle/refs/heads/main/public/dist/assets/styles/core.css
```

### Minify files

```
minify -s -o minify/ * 
```

## Results

### Size comparison

| File             |  Original |  Minified |  Ratio |   Gain |          Compression |
|------------------|----------:|----------:|-------:|-------:|---------------------:|
| autoComplete.css |   3.09 KB |   2.51 KB | 81.33% | 18.67% | 🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| autoComplete.js  |  19.88 KB |   9.17 KB | 46.13% | 53.87% | 🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️⬜️ |
| bootstrap.css    | 281.05 KB | 231.89 KB | 82.51% | 17.49% | 🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| bootstrap.js     | 145.40 KB |  62.20 KB | 42.76% | 57.24% | 🟩🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️ |
| core.css         | 111.44 KB |  70.37 KB | 63.17% | 36.83% | 🟩🟩🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️ |
| main.js          |  43.39 KB |  19.23 KB | 44.34% | 55.66% | 🟩🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️ |
| video-js.css     |  53.37 KB |  47.06 KB | 88.24% | 11.76% | 🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| video.js         |   2.35 MB | 690.10 KB | 29.33% | 70.67% | 🟩🟩🟩🟩🟩🟩🟩⬜️⬜️⬜️ | 

### Transfert comparison (gzip)

| File             |   Original |  Minified |  Ratio |   Gain |          Compression |
|------------------|-----------:|----------:|-------:|-------:|---------------------:|
| autoComplete.css |    1.08 KB |   0.89 KB | 82.41% | 17.59% | 🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| autoComplete.js  |    5.59 KB |   2.68 KB | 47.96% | 52.04% | 🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️⬜️ |
| bootstrap.css    |   33.56 KB |  28.94 KB | 86.08% | 13.92% | 🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| bootstrap.js     |   29.92 KB |  12.58 KB | 42.06% | 57.94% | 🟩🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️ |
| core.css         |   21.98 KB |  13.65 KB | 62.13% | 37.87% | 🟩🟩🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️ |
| main.js          |   10.44 KB |   5.89 KB | 56.45% | 43.55% | 🟩🟩🟩🟩⬜️⬜️⬜️⬜️⬜️⬜️ |
| video-js.css     |   13.14 KB |  12.72 KB | 96.79% |  3.21% | 🟩⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️⬜️ |
| video.js         |  538.83 KB | 202.62 KB | 37.61% | 62.39% | 🟩🟩🟩🟩🟩🟩⬜️⬜️⬜️⬜️ |
