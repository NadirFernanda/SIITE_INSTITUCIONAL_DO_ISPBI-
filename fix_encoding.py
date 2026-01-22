import os
import glob

# Mapeamento de correções de encoding
fixes = {
    'EXCELÃŠNCIA': 'EXCELÊNCIA',
    'EDUCAÃ‡ÃƒO': 'EDUCAÇÃO',
    'CONHEÃ‡A': 'CONHEÇA',
    'INVESTIGAÃ‡ÃƒO': 'INVESTIGAÇÃO',
    'INOVAÃ‡ÃƒO': 'INOVAÇÃO',
    'cientÃ­fico': 'científico',
    'EXTENSÃƒO': 'EXTENSÃO',
    'COMUNITÃRIA': 'COMUNITÁRIA',
    'BiÃ©': 'Bié',
    'Ã©': 'é',
    'Ã­': 'í',
    'Ã³': 'ó',
    'Ãº': 'ú',
    'Ã£': 'ã',
    'Ã§': 'ç',
    'ÃƒO': 'ÃO',
    'Ã‡': 'Ç',
    'Ãš': 'Ê',
}

# Reverter cores também
color_fixes = {
    'from-[#1A365D] to-[#2D3748]': 'from-[#2C4A5E] to-[#0E8F81]',
    'from-[#4A5568] to-[#718096]': 'from-[#F05A28] to-[#FFD700]',
    'from-[#718096] to-[#4A5568]': 'from-[#FFD700] to-[#F05A28]',
    'bg-[#1A365D]': 'bg-[#0E8F81]',
    'text-[#1A365D]': 'text-[#0E8F81]',
    'border-[#1A365D]': 'border-[#0E8F81]',
    'bg-[#2D3748]': 'bg-[#39C28A]',
    'text-[#2D3748]': 'text-[#39C28A]',
    'bg-[#4A5568]': 'bg-[#F05A28]',
    'text-[#4A5568]': 'text-[#F05A28]',
    'border-[#4A5568]': 'border-[#F05A28]',
    'to-[#2D3748]': 'to-[#0E8F81]',
    'to-[#718096]': 'to-[#FFD700]',
}

# Processar todos os arquivos blade.php
views_path = r'C:\Users\Administrator\Documents\SITE_ACTUALIZADO\VersaoDevNew\resources\views'
for root, dirs, files in os.walk(views_path):
    for file in files:
        if file.endswith('.blade.php'):
            filepath = os.path.join(root, file)
            try:
                with open(filepath, 'r', encoding='utf-8') as f:
                    content = f.read()
                
                original_content = content
                
                # Corrigir encoding
                for wrong, correct in fixes.items():
                    content = content.replace(wrong, correct)
                
                # Reverter cores
                for wrong_color, correct_color in color_fixes.items():
                    content = content.replace(wrong_color, correct_color)
                
                # Salvar apenas se houve mudanças
                if content != original_content:
                    with open(filepath, 'w', encoding='utf-8') as f:
                        f.write(content)
                    print(f'Fixed: {filepath}')
                    
            except Exception as e:
                print(f'Error processing {filepath}: {e}')

print('Done!')
