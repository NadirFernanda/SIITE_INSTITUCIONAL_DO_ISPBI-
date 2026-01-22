import os

# Cores institucionais
AZUL_CLARO = '#2563eb'  # Azul institucional
AMARELO = '#FFD700'     # Amarelo institucional

# Tons de lilás/roxo comuns
lilas_cores = [
    '#8B5CF6', # Tailwind purple-500
    '#7C3AED', # Tailwind purple-600
    '#A21CAF', # Tailwind fuchsia-800
    '#9333EA', # Tailwind purple-600
    '#6D28D9', # Tailwind purple-700
    '#C026D3', # Tailwind fuchsia-600
    '#A78BFA', # Tailwind purple-400
    '#D946EF', # Tailwind fuchsia-500
    '#A855F7', # Tailwind purple-500
    '#9D174D', # Roxo escuro
    '#9F7AEA', # Roxo claro
    '#7C3AED', # Roxo médio
    '#8B5CF6', # Roxo médio
    '#6D28D9', # Roxo escuro
    '#C084FC', # Roxo claro
    '#E879F9', # Roxo claro
    '#F472B6', # Rosa
    '#F0ABFC', # Roxo claro
    '#E0E7FF', # Roxo muito claro
]

# Substituir todos os tons de lilás/roxo por azul institucional
substituicoes = {cor: AZUL_CLARO for cor in lilas_cores}

# Substituir gradientes roxo->azul por azul->azul
substituicoes['from-[#8B5CF6] to-[#2563eb]'] = f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO}]'
substituicoes['from-[#9333EA] to-[#2563eb]'] = f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO}]'
substituicoes['from-[#A21CAF] to-[#2563eb]'] = f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO}]'
substituicoes['from-[#A855F7] to-[#2563eb]'] = f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO}]'

base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.blade.php'):
            path = os.path.join(root, file)
            with open(path, 'r', encoding='utf-8') as f:
                content = f.read()
            original = content
            for old, new in substituicoes.items():
                content = content.replace(old, new)
            if content != original:
                with open(path, 'w', encoding='utf-8') as f:
                    f.write(content)
                print(f'Lilas removido: {file}')
print('Todos os tons de lilás/roxo foram substituídos por azul institucional.')
