import os
import re

# Azul institucional principal
AZUL = '#1A365D'
AZUL_ESCURO = '#2C4A5E'
AZUL_CLARO = '#3B5998'
CINZA = '#4A5568'

# Substituições de cores vibrantes para tons institucionais
substituicoes = {
    # Verdes e laranjas para azul
    '#0E8F81': AZUL, '#39C28A': AZUL_CLARO, '#F05A28': AZUL, '#FFD700': AZUL_CLARO,
    '#8BC34A': AZUL_CLARO, '#2C4A5E': AZUL_ESCURO, '#0288D1': AZUL_CLARO,
    '#E91E63': AZUL_CLARO, '#B93C86': AZUL_CLARO, '#FF7043': AZUL_CLARO,
    # Gradientes
    'from-[#0E8F81] to-[#39C28A]': f'from-[{AZUL}] to-[{AZUL_CLARO}]',
    'from-[#F05A28] to-[#FFD700]': f'from-[{AZUL}] to-[{AZUL_CLARO}]',
    'from-[#39C28A] to-[#0E8F81]': f'from-[{AZUL_CLARO}] to-[{AZUL}]',
    'from-[#2C4A5E] to-[#0288D1]': f'from-[{AZUL_ESCURO}] to-[{AZUL_CLARO}]',
    'from-[#8BC34A] to-[#0E8F81]': f'from-[{AZUL_CLARO}] to-[{AZUL}]',
    'from-[#E91E63] to-[#B93C86]': f'from-[{AZUL_CLARO}] to-[{AZUL_CLARO}]',
    'from-[#F05A28] to-[#FF7043]': f'from-[{AZUL}] to-[{AZUL_CLARO}]',
    'from-[#FF7043] to-[#F05A28]': f'from-[{AZUL_CLARO}] to-[{AZUL}]',
    'from-[#0288D1] to-[#0E8F81]': f'from-[{AZUL_CLARO}] to-[{AZUL}]',
    # Bordas e detalhes
    'border-[#39C28A]': f'border-[{AZUL_CLARO}]',
    'border-[#0E8F81]': f'border-[{AZUL}]',
    'border-[#F05A28]': f'border-[{AZUL}]',
    # Textos
    'text-[#2C4A5E]': f'text-[{AZUL_ESCURO}]',
    'text-[#39C28A]': f'text-[{AZUL_CLARO}]',
    'text-[#F05A28]': f'text-[{AZUL}]',
    # Foco
    'focus:ring-[#F05A28]': f'focus:ring-[{AZUL}]',
}

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
                print(f'Atualizado: {file}')
print('Cores institucionais azul aplicadas.')
