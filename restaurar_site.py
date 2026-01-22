import os
import re

base_dir = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'

# Mapeamento de correções de acentuação e cores
replacements = {
    # Palavras e letras corrompidas comuns
    'Ã¡': 'á', 'Ã¢': 'â', 'Ã£': 'ã', 'Ã©': 'é', 'Ãª': 'ê', 'Ã­': 'í', 'Ã³': 'ó', 'Ãµ': 'õ', 'Ãº': 'ú', 'Ã§': 'ç',
    'Ã€': 'À', 'Ã‚': 'Â', 'Ãƒ': 'Ã', 'Ã‰': 'É', 'ÃŠ': 'Ê', 'ÃŒ': 'Ì', 'Ã“': 'Ó', 'Ã•': 'Õ', 'Ãš': 'Ú', 'Ã‡': 'Ç',
    'Ã': 'Í', 'Ã': 'Á', 'Ã“': 'Ó', 'Ãš': 'Ú',
    'Ã‰': 'É', 'ÃŠ': 'Ê', 'Ã': 'Í', 'Ã“': 'Ó', 'Ãš': 'Ú',
    'Ã“': 'Ó', 'Ãš': 'Ú',
    'Ã“': 'Ó',
    'Ã­': 'í',
    'Ãº': 'ú',
    'Ã§': 'ç',
    'Ã‰': 'É',
    'Ãª': 'ê',
    'Ã³': 'ó',
    'Ã£': 'ã',
    'Ã¡': 'á',
    'Ã¢': 'â',
    'Ãº': 'ú',
    'Ã§': 'ç',
    'Ã“': 'Ó',
    'Ã‰': 'É',
    'ÃŠ': 'Ê',
    'Ã': 'Í',
    'Ã“': 'Ó',
    'Ãš': 'Ú',
    'Ã‡': 'Ç',
    'Ã': 'Í',
    'Ã': 'Á',
    'Ã“': 'Ó',
    'Ãš': 'Ú',
    'Ã‰': 'É',
    'ÃŠ': 'Ê',
    'Ã': 'Í',
    'Ã“': 'Ó',
    'Ãš': 'Ú',
    'Ã“': 'Ó',
    'Ãš': 'Ú',
    'Ã“': 'Ó',
    'Ã­': 'í',
    'Ãº': 'ú',
    'Ã§': 'ç',
    'Ã‰': 'É',
    'Ãª': 'ê',
    'Ã³': 'ó',
    'Ã£': 'ã',
    'Ã¡': 'á',
    'Ã¢': 'â',
    'Ãº': 'ú',
    'Ã§': 'ç',
    # Palavras inteiras
    'EXCELÃŠNCIA': 'EXCELÊNCIA',
    'EDUCAÃ‡ÃƒO': 'EDUCAÇÃO',
    'INVESTIGAÃ‡ÃƒO': 'INVESTIGAÇÃO',
    'INOVAÃ‡ÃƒO': 'INOVAÇÃO',
    'EXTENSÃƒO': 'EXTENSÃO',
    'COMUNITÃRIA': 'COMUNITÁRIA',
    'GRADUAÃ‡ÃƒO': 'GRADUAÇÃO',
    'POLITÃ‰CNICO': 'POLITÉCNICO',
    'BIÃ‰': 'BIÉ',
    'BiÃ©': 'Bié',
    'MESTRADO': 'MESTRADO',
    # Cores originais
    '#1A365D': '#2C4A5E',
    '#2D3748': '#0E8F81',
    '#4A5568': '#F05A28',
    '#718096': '#FFD700',
    'from-[#1A365D] to-[#2D3748]': 'from-[#2C4A5E] to-[#0E8F81]',
    'from-[#4A5568] to-[#718096]': 'from-[#F05A28] to-[#FFD700]',
    'from-[#0E8F81] to-[#39C28A]': 'from-[#0E8F81] to-[#39C28A]',
    'from-[#F05A28] to-[#FFD700]': 'from-[#F05A28] to-[#FFD700]',
}

def fix_file(filepath):
    with open(filepath, 'r', encoding='utf-8', errors='replace') as f:
        content = f.read()
    original = content
    for wrong, right in replacements.items():
        content = content.replace(wrong, right)
    if content != original:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f'Corrigido: {filepath}')

for root, dirs, files in os.walk(base_dir):
    for file in files:
        if file.endswith('.blade.php'):
            fix_file(os.path.join(root, file))
print('Correção completa finalizada.')
